<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATCH IT GAMES</title>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
      @vite('resources/css/app.css')
      <style>
        .card{
            height:180px;
            width: 140px;
            position: relative;
            transform-style: preserve-3d;
            transition: 1s ease;
            perspective: 500px;
        }

        .card-front{
            background-color: #F6F7D7;
            font-size: 24px;
            transform: rotateY(180deg);
        }
            
        .card-back{
            background-color: #FBC907;
           
        }

        .card-front, .card-back{
            position: absolute;
            backface-visibility: hidden;
            height: 100%;
            width: 100%;         
            border-radius: 10px;   
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card.flipped{
            transform: rotateY(180deg);
        }
        
      </style>
</head>
<body class="bg-red-700">
    <div class="mx-auto h-500px">
        <h1 class="text-center text-5xl font-bold my-8">Match Me!</h1>
        <button id='start' class="bg-yellow-300 h-12 w-64 my-8 rounded text-xl absolute top-0 right-0 mr-12 hover:bg-yellow-100">Start Game</button>
        <div id="board" class="grid grid-cols-5 gap-4 mx-72 mt-12 justify-items-center">
            {{-- Kartu yang ditampilkan --}}
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    const cardlist = ['1','2','3','4','5','6','7','8','9','10','1','2','3','4','5','6','7','8','9','10'];
    let firstCard,secondCard;
    let lockBoard = false;
    let match = 0;

    $(document).ready(function () {
        shuffleCard();
        generateCard();
    });

    $('#start').click(function () { 
        lookTime();
    }); 

    function generateCard(){
        cardlist.forEach(element => {
            const card = `
                <div class="card"> 
                     <div class="card-front">${element}</div>
                     <div class="card-back"></div>
                </div>
                `;                   
            $('#board').append(card);
        });
      
    }

    function shuffleCard(){
        let currentIndex = cardlist.length,
        randomIndex,
        temporaryValue;
        while (currentIndex !== 0) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = cardlist[currentIndex];
            cardlist[currentIndex] = cardlist[randomIndex];
            cardlist[randomIndex] = temporaryValue;
        }
    }

    function cardClick(card){
        if (lockBoard) return;
        if (card.is(firstCard)) return;
        card.addClass('flipped');

        if(!firstCard){
            firstCard = card;
        }
        else{
            secondCard = card;
            lockBoard=true;
            checkMatch();
        }
    }
    
    function checkMatch(){
        if(firstCard.text() === secondCard.text()){
           firstCard.off('click');
           secondCard.off('click');
           match++;
           reset();
           checkWin();
        }
        else{
            setTimeout(() => {
            firstCard.removeClass('flipped');
            secondCard.removeClass('flipped');
            reset();
        }, 1000);
        }
    }

    function reset(){
        firstCard = null;
        secondCard = null;
        lockBoard = false;
    }

    function checkWin(){
        if(match === 10){
            alert("WIN");
            $('#start').attr('disabled',false);
        }
    }

    function lookTime(){
        cardlist.forEach(element => {            
            $('.card').addClass('flipped');
        });        
        $('#start').attr('disabled',true);

        setTimeout(() => {
            cardlist.forEach(element => {            
            $('.card').removeClass('flipped');   
        });
        $('.card').on('click', function () {
                cardClick($(this));
            });
        }, 3000);
    }
    
</script>
</html>