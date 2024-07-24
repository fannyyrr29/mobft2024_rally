<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRACK THE CODE</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <style>
        .locked-box{
            animation: shake 5s ease 1 normal forwards;
            animation-iteration-count: infinite;
        }
        .center{
            display:flex;
            text-align:center;
            justify-content:center;
            align-items:center;
        }
        @keyframes shake {
            0%,
            40% {
                transform: rotate(0deg);
                transform-origin: 50% 50%;
            }

            10% {
                transform: rotate(4deg);
            }

            8%,
            16%,
            24% {
                transform: rotate(-5deg);
            }

            12%,
            20%,
            28% {
                transform: rotate(5deg);
            }

            32% {
                transform: rotate(-4deg);
            }

            36% {
                transform: rotate(4deg);
            }
        }

        .question{
            border: 3px solid maroon;
        }
    </style>
</head>
<body class="bg-red-500">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const questions = {
                'ASTA':{question:'FAKULTAS TEKNIK UBAYA didirikan pada tahun', a:'1989', b:'1986', c:'1982', d:'1980', ans:'1986'},
                'MABA':{question:'They ___ to the carnival every year', a:'go', b:'goes', c:'going', d:'gone', ans:'go'},
                'MAHS':{question:'Februari 2024 memiliki berapa hari', a:'27', b:'28', c:'29', d:'30', ans:'29'},
                'KAMP':{question:'5, 10, 8, 13, 11, 16, …, …, …, …<br>Angka setelah angka 16 adalah…', a:'14', b:'19', c:'17', d:'20', ans:'14'},
                'ORTN':{question:'Nama Dosen Koordinator Kemahasiswaan adalah…', a:'Bu Maya', b:'Pak Susila', c:'Pak Eric', d:'Pak Argo', ans:'Pak Argo'},
                'PADA':{question:'Lapangan kecil yang menjadi Icon dari Fakultas Teknik adalah..', a:'Boulebard', b:'Lapangan USC', c:'Boulevard', d:'Gazebo Teknik', ans:'Boulevard'},
                'TEKN':{question:'(1/2)+(1/3):(4/5)', a:'26/24', b:'22/24', c:'28/24', d:'20/24', ans:'22/24'},
                'FTTK':{question:'Ruang Dekan dan Wakil Dekan Fakultas Teknik ada di..', a:'TC 2.1', b:'TF lantai 1', c:'TB lantai 2', d:'TA 200', ans:'TA 200'},
                'MOBT':{question:'Ada berapa ormawa di Fakultas Teknik?', a:'9', b:'10', c:'11', d:'12', ans:'11'},
                'SFTK':{question:'Perhatikan Algoritma dibawah ini:<br>0. start<br>1. input hargaBuku<br>2. input jumlahBuku<br>3. totalBayar = hargaBuku * jumlahBuku<br>4. display totalBayar<br>5. end<br>Dari algoritma di atas, variabel mana yang cocok apabila ingin menginputkan nominal harga buku?', a:'jumlahBuku', b:'totalBayar', c:'hargaBuku', d:'display', ans:'hargaBuku'}
            };
            let score = 0;
            let inputValue;
            let lockedCode;

            $('#code').click(function () { 
                inputValue = $('#input').val().trim().toUpperCase();
                Quest();
            });

            function Quest(){
                if (questions[inputValue] && inputValue!=lockedCode) {
                    const q = `
                    <div class="mx-auto text-center">
                    <p class="text-left bg-red-300 p-3 rounded my-5">
                        ${questions[inputValue].question}
                    </p>
                    <div class="d-grid">
                        <button id='a' class="bg-yellow-300 h-12 w-48 m-3 rounded text-xl hover:bg-yellow-100" style="width:40%">A. ${questions[inputValue].a}</button>
                        <button id='b' class="bg-yellow-300 h-12 w-48 m-3 rounded text-xl hover:bg-yellow-100" style="width:40%">B. ${questions[inputValue].b}</button>
                    </div>
                    <div class="d-grid">
                        <button id='c' class="bg-yellow-300 h-12 w-48 m-3 rounded text-xl hover:bg-yellow-100" style="width:40%">C. ${questions[inputValue].c}</button>
                        <button id='d' class="bg-yellow-300 h-12 w-48 m-3 rounded text-xl hover:bg-yellow-100" style="width:40%">D. ${questions[inputValue].d}</button>
                    </div>
                    </div>`;
                    $("#question").append(q);

                    $('#a').click(function () { checkAnswer('a'); });
                    $('#b').click(function () { checkAnswer('b'); });
                    $('#c').click(function () { checkAnswer('c'); });
                    $('#d').click(function () { checkAnswer('d'); });

                    $('#input').attr('disabled',true);
                    $('#code').attr('disabled',true);
                }
                else if(inputValue==lockedCode && inputValue!=''){
                    alert("Kode Soal ditolak. Masukkan kode soal yang lain");
                    $("#input").val('');
                } 
                else {
                    alert('kode soal invalid');
                }
            }

            function checkAnswer(option){
                if(questions[inputValue][option] == questions[inputValue].ans){
                    alert("jawaban benar");
                    score++;
                    if(score<5){
                        $('#box').attr('src','images/Box Game '+score+'-01.png');
                    }
                    if(score==5){
                        $('#box').attr('src','images/Box Game box-01.png');
                        $('#box').removeClass('locked-box');
                        alert('menang');
                        delete questions;
                    }
                    delete questions[inputValue];
                    lockedCode = '';
                }
                else{
                    alert("jawaban salah, soal akan dikunci selama 1 putaran");
                    lockedCode = inputValue;
                }
                inputValue = '';

                if(score<5){
                    $('#input').removeAttr('disabled');
                    $('#code').removeAttr('disabled');
                }

                $("#question").empty();
                $("#input").val('');
            }
        });
    </script>
    <h1 class="text-center text-5xl font-bold my-8">Crack the Code !</h1>
    <div class="mx-auto center">
        <div class="center"><img src="images/Box Game 0-01.png" alt="box" class="locked-box w-72" id="box"></div>
        <br>
        <div>
            <input type="text" name="input" id="input" class="h-12 w-64 rounded m-3 p-3" style="font-weight: bold; font-size:32px; text-align:center" maxlength="4">
            <br>
            <button id='code' class="bg-yellow-300 h-12 w-64 m-3 rounded text-xl hover:bg-yellow-100">ENTER CODE</button>
        </div>
    </div>
    <div class="question rounded mx-12 py-3 px-12" id="question">
        {{-- container pertanyaan --}}
    </div>
</body>

</html>