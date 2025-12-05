<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCar($request);
        
        $heroImagePath = null;
        if ($request->hasFile('image_file')) {
            $heroImagePath = $request->file('image_file')->store('cars', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $galleryPaths[] = $file->store('cars/gallery', 'public'); 
            }
        }
        
        $dataToStore = $request->only([
            'name', 'series', 'slogan', 'tagline', 'description', 
            'model_3d_url', 'video_url'
        ]);

        $dataToStore['image_url'] = $heroImagePath; 
        
        $dataToStore['gallery_images'] = json_encode($galleryPaths); 

        $dataToStore['stats'] = $request->input('stats_data');
        $dataToStore['specs'] = $request->input('specs_data');

        $dataToStore['model_key'] = Str::slug($dataToStore['name']);

        Car::create($dataToStore); 

        return redirect()->route('admin.cars.index')->with('success', 'Đã thêm siêu xe mới thành công!');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validatedData = $this->validateCar($request, $car->id);

        if ($request->hasFile('image_file')) {
            if ($car->image_url && Storage::disk('public')->exists($car->image_url)) {
                Storage::disk('public')->delete($car->image_url);
            }
            $validatedData['image_url'] = $request->file('image_file')->store('cars', 'public');
        }
        
        $galleryPaths = $car->gallery_images ?: [];

        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $galleryPaths[] = $file->store('cars/gallery', 'public');
            }
        }
        
        $dataToUpdate = $request->only([
            'name', 'series', 'slogan', 'tagline', 'description', 
            'model_3d_url', 'video_url'
        ]);
        
        if (isset($validatedData['image_url'])) {
            $dataToUpdate['image_url'] = $validatedData['image_url']; 
        }
        
        $dataToUpdate['gallery_images'] = json_encode($galleryPaths); 
        
        $dataToUpdate['stats'] = $request->input('stats_data');
        $dataToUpdate['specs'] = $request->input('specs_data');
        
        $dataToUpdate['model_key'] = Str::slug($dataToUpdate['name']);

        $car->update($dataToUpdate);

        return redirect()->route('admin.cars.index')->with('success', 'Cập nhật thông tin xe thành công!');
    }

    public function destroy(Car $car)
    {
        if ($car->image_url && Storage::disk('public')->exists($car->image_url)) {
            Storage::disk('public')->delete($car->image_url);
        }
        
        $galleryImages = $car->gallery_images;
        if (is_string($galleryImages)) {
            $galleryImages = json_decode($galleryImages, true);
        }

        if ($galleryImages && is_array($galleryImages)) {
            foreach ($galleryImages as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
        
        $car->delete();
        return back()->with('success', 'Đã xóa xe khỏi hệ thống.');
    }

    private function validateCar($request, $id = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'series' => 'required|string',
            'slogan' => 'required|string',
            'tagline' => 'nullable|string',
            'description' => 'required|string',
            
            'image_file' => $id ? 'nullable|image|max:5000' : 'required|image|max:5000', 
            
            'gallery_files' => 'nullable|array', 
            'gallery_files.*' => 'image|max:5000', 
            
            'stats_data' => 'required|json', 
            'specs_data' => 'required|json',
            'model_3d_url' => 'nullable|string',
            'video_url' => 'nullable|url',
        ]);
    }
}