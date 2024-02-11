<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email_user' => 'required|email|max:50|unique:tbl_user',
            'password' => 'required',
            'foto_profil.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|in:Ketua DKM,Bendahara,Warga Sekolah',
        ];
    }
    public function store(StoreUserRequest $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $uploadedImage = $request->image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;

        $params = $request->validated();
        
        if ($product = Product::create($params)) {
            $product->image = $imagePath;
            $product->save();

            return redirect(route('dashboard.users.index', 'dashboard.users.show'))->with('success', 'Added!');
        }
    }
}