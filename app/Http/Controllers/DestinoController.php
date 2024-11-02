<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;
use Exception;

class DestinoController extends Controller
{

    protected $destino;
    public function __construct(Destino $destino){
        $this->destino = $destino;
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinos = $this->destino->paginate(5);

        return view('pages.destino.index', compact('destinos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages.destino.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        try {
            // Valida os dados com base nas regras definidas no modelo.
            $validatedData = $request->validate($this->destino->rules());
            //dd($validatedData);
    
            // Cria um novo registro com os dados validados.
            $passeio = $this->destino->create([
                'cidade' => $validatedData['cidade'],
                'estado' => $validatedData['estado'],
            ]);
            
            // Redireciona para a rota passeio.index com uma mensagem de sucesso.
            return redirect()->route('destino.index')->with('success', 'Destino criado com sucesso!');
            
        } catch (Exception $e) {
            // Captura a exceção e retorna para a página anterior com a mensagem de erro.
            return redirect()->back()->with('error', 'Erro ao criar destino: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //todos os destinos salvos no banco
        $destinos = $this->destino->get();

        //o destino do id
        $destino = $this->destino->find($id);

        return view('pages.destino.edit', compact('destinos','destino'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Valida os dados com base nas regras definidas no modelo.
            $validatedData = $request->validate($this->destino->rules());
            
            // Encontra o destino existente pelo ID.
            $destino = $this->destino->findOrFail($id);
            
            // Atualiza o registro com os dados validados.
            $destino->update([
                'cidade' => $validatedData['cidade'],
                'estado' => $validatedData['estado'],
            ]);
            
            // Redireciona para a rota destino.index com uma mensagem de sucesso.
            return redirect()->route('destino.index')->with('success', 'Destino atualizado com sucesso!');
            
        } catch (Exception $e) {
            // Captura a exceção e retorna para a página anterior com a mensagem de erro.
            return redirect()->back()->with('error', 'Erro ao atualizar destino: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
;
        try {

            $destino = $this->destino->find($id);
            $destino->delete();
    
            return redirect()->route('destino.index')->with('success', 'Destino excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('destino.index')->with('error', 'Erro ao excluir o destino: ' . $e->getMessage());
        }
    }
}
