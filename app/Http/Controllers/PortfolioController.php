<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Services\PortfolioService;

class PortfolioController extends Controller
{
    private $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function getAllPortfolio()
    {
        return response()->json([
            'data' => $this->portfolioService->getAllPortfolio()
        ]);
    }

    public function createDataPortfolio(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            // 'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        return response()->json([
            'data' => $this->portfolioService->createDataPortfolio($request)
        ]);
    }

     public function getDataPortfolioById($id)
     {
        return response()->json([
            'data' => $this->portfolioService->getDataPortfolioById($id)
        ]);
     }


    //  service repository

    // public function updateDataPortfolio(Request $request, $id)
    // {
    //     $validateData = $request->validate([
    //         'judul' => 'string',
    //         'deskripsi' => 'string',
    //         'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);

    //     return response()->json([
    //         'data' => $this->portfolioService->updateDataPortfolio($request, $id)
    //     ]);
    // }


    // MVC
    public function updateDataPortfolio(Request $request, $id){ 
        $validateData = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $portfolio = Portfolio::find($id);
            $portfolio->judul = $request->judul;
            $portfolio->deskripsi = $request->deskripsi;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imagePath = 'public/image/'.$image->hashName();
    
            // Menyimpan images baru
            $image->storeAs('public/image', $image->hashName());
    
            
            $portfolio->images = $image->hashName();
    
        } 
        $portfolio->save();     
        return response()->json([
            'data' => $portfolio
        ]);
    }
    




    public function deleteDataPortfolio($id)
    {
        return response()->json([
            'message' => $this->portfolioService->deleteDataPortfolio($id),
            'status' => '200'
        ]);
    }
}
