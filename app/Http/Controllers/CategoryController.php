<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::withCount('servers')->with('servers')->orderByDesc('servers_count')->get();
        return response()->json(['success' => true, 'categories' => $categories]);
    }

    public function store(Request $request) {
        if (!isset($request->name)) {
            return response()->json(['success' => false, 'message' => "Podaj nazwe kategorii którą chcesz dodać!"]);
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json(['success' => true, 'category' => $category]);
    }

    public function show($id) {
        $category = Category::where(['id' => $id])->withCount('servers')->with('servers')->orderByDesc('servers_count')->get();
        if (!isset($category)) {
            return response()->json(['success' => false, 'message' => "Podana kategoria nie istnieje!"]);
        }
        return response()->json(['success' => true, 'category' => $category]);
    }
}
