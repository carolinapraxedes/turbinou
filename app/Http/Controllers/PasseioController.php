<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Passeio;
use Illuminate\Http\Request;
use Exception;

class PasseioController extends Controller
{

    protected $passeio;
    protected $destino;


    public function __construct(Passeio $passeio, Destino $destino){
        $this->passeio = $passeio;
        $this->destino = $destino;
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passeios = $this->passeio->with('destino')->paginate(5);


        return view('pages.passeios.index', compact('passeios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //dd(Passeio::all());
        $destinos = $this->destino->all();
        
        return view('pages.passeios.create', compact('destinos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            
            //dd($this->passeio->rules());
            // Valida os dados com base nas regras definidas no modelo.
            $request->validate(
                $this->passeio->rules(),
                $this->passeio->feedback()
            );


            // Inicializa a variável da imagem como null
            $image_urn = null;

            // Verifica se um arquivo de imagem foi enviado
            if ($request->hasFile('imagem')) {
                // O arquivo já foi validado antes de chegar aqui
                $image_urn = $request->file('imagem')->store('imagens', 'public/passeios');
            }
    
            // Cria um novo registro com os dados validados.
            $passeio = $this->passeio->create([
                'destino_id' => $request->destino_id,
                'nome' => $request->nome,
                'horario' => $request->horario,
                'imagem' => $image_urn,
                'descricao' => $request->descricao,

            ]);
            
            // Redireciona para a rota passeio.index com uma mensagem de sucesso.
            return redirect()->route('passeio.index')->with('success', 'Passeio criado com sucesso!');
            
        } catch (Exception $e) {
            // Captura a exceção e retorna para a página anterior com a mensagem de erro.
            return redirect()->back()->with('error', 'Erro ao criar passeio: ' . $e->getMessage());
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
        $passeio = $this->passeio->find($id);
        $destinos = $this->destino->all();
        return view('pages.passeios.edit', compact('passeio','destinos'));    
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
            $request->validate(
                $this->passeio->rules(),
                $this->passeio->feedback()
            );
    
            // Busca o passeio pelo ID
            $passeio = $this->passeio->findOrFail($id);
    
            // Inicializa a variável da imagem como null
            $image_urn = $passeio->imagem; // Mantém a imagem existente
    
            // Verifica se um arquivo de imagem foi enviado
            if ($request->hasFile('imagem')) {
                // O arquivo já foi validado antes de chegar aqui
                $image_urn = $request->file('imagem')->store('imagens', 'public/passeios');
            }
    
            // Atualiza o registro com os dados validados.
            $passeio->update([
                'destino_id' => $request->destino_id,
                'nome' => $request->nome,
                'horario' => $request->horario,
                'imagem' => $image_urn,
                'descricao' => $request->descricao,
            ]);
            
            // Redireciona para a rota passeio.index com uma mensagem de sucesso.
            return redirect()->route('passeio.index')->with('success', 'Passeio atualizado com sucesso!');
            
        } catch (Exception $e) {
            // Captura a exceção e retorna para a página anterior com a mensagem de erro.
            return redirect()->back()->with('error', 'Erro ao atualizar passeio: ' . $e->getMessage());
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
        try {

            $passeio = $this->passeio->find($id);
            $passeio->delete();
    
            return redirect()->route('passeio.index')->with('success', 'Passeio excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('passeio.index')->with('error', 'Erro ao excluir o passeio: ' . $e->getMessage());
        }
    }
    
}
