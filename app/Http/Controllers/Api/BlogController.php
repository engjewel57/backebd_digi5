<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogReview;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    // Get all data for blog listing page
    public function getBlogPageData()
    {
        try {
            $posts = BlogPost::with('category')
                ->where('is_active', true)
                ->orderBy('display_order')
                ->orderBy('created_at', 'desc')
                ->get();
                
            $categories = BlogCategory::where('is_active', true)
                ->orderBy('display_order')
                ->get();
                
            $reviews = BlogReview::where('is_active', true)
                ->orderBy('display_order')
                ->get();

            return response()
                ->json([
                    'success' => true,
                    'posts' => $posts,
                    'categories' => $categories,
                    'reviews' => $reviews
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load blog data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Get single blog post by slug
    public function getBlogBySlug($slug)
    {
        try {
            $post = BlogPost::with('category')
                ->where('slug', $slug)
                ->where('is_active', true)
                ->first();

            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Blog post not found'
                ], 404);
            }
            
            // Get related posts (same category, exclude current)
            $relatedPosts = BlogPost::with('category')
                ->where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->where('is_active', true)
                ->limit(3)
                ->get();

            return response()
                ->json([
                    'success' => true,
                    'post' => $post,
                    'relatedPosts' => $relatedPosts
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load blog post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin: Get all blog posts
    public function getAllPosts()
    {
        try {
            $posts = BlogPost::with('category')
                ->orderBy('display_order')
                ->orderBy('created_at', 'desc')
                ->get();
                
            return response()
                ->json([
                    'success' => true,
                    'data' => $posts
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin: Create blog post
    public function createPost(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'required|string|max:255',
                'excerpt' => 'required|string',
                'content' => 'required|string',
                'category_id' => 'required|exists:blog_categories,id',
                'author' => 'required|string|max:255',
                'image_url' => 'required|url',
                'read_time' => 'required|string|max:50',
            ]);

            $data = $request->all();
            
            // Generate slug from title if not provided
            if (empty($data['slug'])) {
                $data['slug'] = $this->generateUniqueSlug($request->title);
            } else {
                // Validate provided slug uniqueness
                $slugExists = BlogPost::where('slug', $data['slug'])->exists();
                if ($slugExists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Slug already exists'
                    ], 422);
                }
            }

            $post = BlogPost::create($data);
            $post->load('category');
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Blog post created successfully',
                    'data' => $post
                ], 201)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create blog post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin: Update blog post
    public function updatePost(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $post = BlogPost::find($id);
            
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Blog post not found'
                ], 404);
            }
            
            $request->validate([
                'title' => 'sometimes|string|max:255',
                'slug' => 'sometimes|string|max:255',
                'excerpt' => 'sometimes|string',
                'content' => 'sometimes|string',
                'category_id' => 'sometimes|exists:blog_categories,id',
                'author' => 'sometimes|string|max:255',
                'image_url' => 'sometimes|url',
            ]);

            $data = $request->all();
            
            // Handle slug update
            if ($request->has('slug') && !empty($request->slug) && $request->slug !== $post->slug) {
                // Validate slug uniqueness
                $slugExists = BlogPost::where('slug', $request->slug)
                    ->where('id', '!=', $id)
                    ->exists();
                    
                if ($slugExists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Slug already exists'
                    ], 422);
                }
                
                $data['slug'] = $request->slug;
            } else {
                // Remove slug from data to prevent updating it
                unset($data['slug']);
            }

            $post->update($data);
            $post->load('category');
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Blog post updated successfully',
                    'data' => $post
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update blog post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin: Delete blog post
    public function deletePost($id)
    {
        try {
            $post = BlogPost::find($id);
            
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Blog post not found'
                ], 404);
            }

            $post->delete();
            
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Post deleted successfully'
                ], 200)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete blog post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Categories CRUD
    public function getCategories()
    {
        try {
            $categories = BlogCategory::orderBy('display_order')->get();
            
            return response()
                ->json([
                    'success' => true,
                    'data' => $categories
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createCategory(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $data['slug'] = $this->generateUniqueCategorySlug($request->name);

            $category = BlogCategory::create($data);
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Category created successfully',
                    'data' => $category
                ], 201)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $category = BlogCategory::find($id);
            
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }
            
            $data = $request->all();
            
            // If name is being updated, regenerate slug
            if ($request->has('name') && $request->name !== $category->name) {
                $data['slug'] = $this->generateUniqueCategorySlug($request->name, $id);
            }

            $category->update($data);
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Category updated successfully',
                    'data' => $category
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = BlogCategory::find($id);
            
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }
            
            // Check if category has posts
            $postsCount = BlogPost::where('category_id', $id)->count();
            if ($postsCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete category with existing posts'
                ], 400);
            }
            
            $category->delete();
            
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Category deleted successfully'
                ], 200)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Reviews CRUD
    public function getReviews()
    {
        try {
            $reviews = BlogReview::orderBy('display_order')->get();
            
            return response()
                ->json([
                    'success' => true,
                    'data' => $reviews
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load reviews',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createReview(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'review' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
                'avatar' => 'required|url',
            ]);

            $review = BlogReview::create($request->all());
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Review created successfully',
                    'data' => $review
                ], 201)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create review',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateReview(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $review = BlogReview::find($id);
            
            if (!$review) {
                return response()->json([
                    'success' => false,
                    'message' => 'Review not found'
                ], 404);
            }

            $review->update($request->all());
            
            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Review updated successfully',
                    'data' => $review
                ])
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update review',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteReview($id)
    {
        try {
            $review = BlogReview::find($id);
            
            if (!$review) {
                return response()->json([
                    'success' => false,
                    'message' => 'Review not found'
                ], 404);
            }

            $review->delete();
            
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Review deleted successfully'
                ], 200)
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete review',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Helper function to generate unique slug for blog posts
    private function generateUniqueSlug($title, $excludeId = null)
    {
        // Generate base slug from title
        $slug = Str::slug($title);
        
        // If slug is empty (e.g., all Bengali characters), use a fallback
        if (empty($slug)) {
            $slug = 'blog-post-' . time();
        }
        
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug exists and make it unique
        while (true) {
            $query = BlogPost::where('slug', $slug);
            
            // Exclude current post when updating
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            
            if (!$query->exists()) {
                break;
            }
            
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    // Helper function to generate unique slug for categories
    private function generateUniqueCategorySlug($name, $excludeId = null)
    {
        // Generate base slug from name
        $slug = Str::slug($name);
        
        // If slug is empty (e.g., all Bengali characters), use a fallback
        if (empty($slug)) {
            $slug = 'category-' . time();
        }
        
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug exists and make it unique
        while (true) {
            $query = BlogCategory::where('slug', $slug);
            
            // Exclude current category when updating
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            
            if (!$query->exists()) {
                break;
            }
            
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
}