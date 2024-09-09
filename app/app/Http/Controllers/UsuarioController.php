<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
        public function index()
        {
            $id=Auth::id();
            $user = User::find($id);
            //busco la información de valoracion del cliente//
                $query="SELECT COUNT(*) as num FROM pedidos WHERE user='$id';";
                $compras= DB::select($query);

                $query="SELECT sum(rating) as suma, count(id) as num FROM valoraciones
                WHERE usuario='$id' and tipo='2'";
                $valoraciones = DB::select($query);
                if($valoraciones[0]->num){
                  $ratingcli= round($valoraciones[0]->suma/$valoraciones[0]->num);
                }
                else{
                  $ratingcli=0;
                }

                $query="SELECT * FROM valoraciones
                WHERE usuario='$id' and tipo='2' order by pedido DESC";
                $valoraciones = DB::select($query);

            //fin valoracion

            return view('auth.perfil',compact('user','compras','ratingcli','valoraciones'));
        }

        public function foto(Request $request)
        {
          //eliminar foto anterior
          if ($request->foto) {
                  if(file_exists(public_path('storage/app/public/uploads/'.$request->foto))){
                    unlink(public_path('storage/app/public/uploads/'.$request->foto));
                  }else{
                    //dd('File does not exists.');
                  }
          }
          //fin eliminar
          //$user->update($request->all());
          $image       = $request->file('img');
          $filename    = time().time().'.'.$image->getClientOriginalExtension();
          $image_resize = Image::make($image->getRealPath());
          $image_resize->resize(200, 200);
          $image_resize->save(public_path('storage/app/public/uploads/' .$filename));
          $namefoto=$filename;

          $id=Auth::id();

          $user = User::find($id);
          $user->foto=$namefoto;
          $user->save();

          return redirect()->route('perfil.index');
        }


        public function edit(User $user)
        {
          $id=Auth::id();
          $user = User::find($id);
          return view('auth.edit',compact('user'));
        }

        public function update(Request $request, User $user)
        {
            $id=Auth::id();
            $user = User::find($id);
            $user->update($request->all());
            return redirect('perfil');
        }




}
