<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Retorna uma lista em JSON com todas as publicações
     */
    public function index() : JsonResponse
    {
        return response()->json(Post::all(), 200);
    }

    /**
     * Cria uma publicação e retorna ela em JSON
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        return response()->json(Post::create($request->all()), 201);
    }

    /**
     * Retorna um objeto JSON de uma publicação específica
     * 
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        return response()->json(Post::findOrFail($id), 200);
    }

    /**
     * Atualiza uma publicação específica e retorna ela
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function update(Request $request, int $id) : JsonResponse
    {
        $post = Post::findOrFail($id);

        $post->update($request->all());

        return response()->json($post, 200);
    }

    /**
     * Deleta uma publicação específica
     * 
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function destroy(int $id) : JsonResponse
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json([
            'message' => 'Deleted successfully',
            'status' => true
        ], 200);
    }
}
