<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Exit_;

class DecoderController extends Controller
{
    //
    public function index()
    {
        return view('decode.view');
    }

    public function store(Request $request)
    {
        $json = "";
        $tot = count($request->nota);
        foreach ($request->nota as $require){

            $content = $require->get();
            $sale = simplexml_load_string($content);

            $det       =  (array) $sale->NFe->infNFe->det;
            $store     =   $sale->NFe->infNFe->emit;
            $destin    =  (empty($sale->NFe->infNFe->dest)) ? 10 : (array) $sale->NFe->infNFe->dest;
            $total     =  (array) $sale->NFe->infNFe->total;
            $payment   =  (array) $sale->NFe->infNFe->pag->detPag;
            $pagTot   =   (array) $sale->NFe->infNFe->total->ICMSTot;
            $operacao  =  (array) $sale->NFe->infNFe->ide;
            $protocolo =  (string) $sale->protNFe->infProt->nProt;
            $KeyAcess =   (string) $sale->protNFe->infProt->chNFe;

            $percent = round(($pagTot['vProd'] - $sale->NFe->infNFe->pag->detPag->vPag) / $pagTot['vProd'] * 100);

            $razaosocial = false;
            if ($destin == 10) {
                $cod_client = 10;
            } elseif (array_keys($destin)[0] == 'CNPJ') {
                $cod_client = $destin['CNPJ'];
                $razaosocial = true;
            } else {
                $cod_client = $destin['CPF'];
            }

            $jsonn = [
                'CdVenda' => 0,
                'NrDocFiscalVenda' => $operacao['nNF'],
                'DataHoraVenda' => $operacao['dhEmi'],
                'DataHoraUltAlteracaoVenda' => $operacao['dhEmi'],
                'SiglaTipoDocFiscal' => "NFCE",
                'SiglaStatusVenda' => "VF",
                'IdNFe' => $KeyAcess,
                'NrProtocoloNFe' => $protocolo,
                'NomeFuncionario' => "",
                'CdCliente' => (int) $cod_client,
                'NomeCliente' => ($cod_client == 10) ? 'CONSUMIDOR' : $destin['xNome'],
                'RazaoSocialCliente' => ($razaosocial) ? $destin['xNome'] : '',
                'FoneClienteVenda' => "",
                'EmailClienteVenda' => "",
                'ContatoClienteVenda' => "",
                'ValorTotalPlanoPagtoVenda' => (float) $payment['vPag'],
                'ValorTotalVenda' => (float) $pagTot['vProd'],
                'ValorRecebido' => (float) $payment['vPag'],
                'ValorFrete' => (float) $pagTot['vFrete'],
                'itens' =>  [],
                'formaPagamentos' => []
            ];
            foreach ($sale->NFe->infNFe->pag->detPag as $formPg) {
                    $jsonn['formaPagamentos'][] = [
                    'CdVenda' => 0,
                    'NomePlano' => (empty($formPg->xPag)) ? 'Outros' : (string) $formPg->xPag,
                    'ValorFinalParcela' => (float) $formPg->vPag
                ];
                // $valor_pago =+ number_format($valueProd, 2, ',', '.');
            }
            // dd($sale->NFe->infNFe->det->children());
            foreach ($sale->NFe->infNFe->det as $prod) {
                $jsonn['itens'][] = [
                    'IDKeyItemVenda' => (int) (int) $prod->attributes()['nItem'],
                    'CdVenda' => 0,
                    'CdProduto' => (string) $prod->prod->cProd,
                    'NrItemVenda' => 1,
                    'DescricaoProduto' => (string) $prod->prod->xProd,
                    'QtdeItemVenda' => (int) round($prod->prod->qCom),
                    'PrecoItemVenda' => (float) $prod->prod->vProd,
                    'ValorDescontoItemVenda' => 0,
                    'CustoItemVenda' => ($prod->prod->vProd - ($prod->prod->vProd / 100 * 20)) / 2,
                    'UltPrecoCpaProdutoForn' => 105,
                    'valorLiquidoVenda' => (float) $payment['vPag'],
                    'CdFornecedor' => 1,
                    'CPF_CNPJFornecedor' => '',
                    'NomeFornecedor' => '',
                    'RazaoSocialFornecedor' => '',
                    'DataCadastroProduto' => ''
                ];
            }
            /* Retorna um json sem escapar a contra barra(/)*/
            $json .= json_encode($jsonn, JSON_UNESCAPED_SLASHES) . ',';
            $NrFisc = $operacao['nNF'];

        }
        $json = preg_replace('/,$/', '', $json);
        return view('decode.add', compact('json','tot'));
    }
}
