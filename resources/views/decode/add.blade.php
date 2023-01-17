<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decodificador de XML</title>
    <meta name="description" content="" />
    <meta name="author" content="Codeconvey" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('storage/decoder/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/decoder/ui/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Only for demo purpose - no need to add.-->
</head>

<body>
    <div class="ScriptTop">
        <div class="rt-container">
            <div class="col-rt-4" id="float-right">
            </div>
        </div>
    </div>
        <header class="ScriptHeader">
            <div class="rt-container">
                <div class="col-rt-12">
                    <div class="rt-heading">
                        <p style="color:wheat;font-size:55px;text-align:center;">Total de {{$tot}} vendas!</p>
                        <p>formatação de xml para json</p>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <center>
                <button class="btn" id="btn">Copiar</button>
                <br /><br />
                <textarea class="textBox" type="text" id="txt" placeholder="Dont belive me?..TEST it here..;)">@php print_r("[".$json ."]") @endphp</textarea><br /><br />
                <a href="/" class="primary btn-primary btn-round-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg> Voltar</a>
            </center>
        </section>
        <script>
            const btn = document.querySelector('#btn');
            const txt = document.querySelector('#txt');

            btn.addEventListener('click', copiaTexto);

            function copiaTexto(e) {
                navigator.clipboard.writeText(txt.innerHTML);
                btn.classList.add('ativo');
                btn.innerText = 'Copiado!';
            }
            setTimeout(() => {
                btn.classList.remove('ativo');
                btn.innerText = 'Copiar';
            }, 4000);
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script href="{{ asset('storage/decoder/script.js') }}"></script>
</body>

</html>
