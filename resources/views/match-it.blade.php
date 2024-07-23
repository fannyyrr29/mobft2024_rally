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

        .card-front img,.card-back img{
            padding: 8px;   
        }
            
        .card-back{
            background-color: maroon;
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
        <p class="text-5xl font-bold left-2"></p>
        <h1 class="text-center text-5xl font-bold my-8">MATCH ME!</h1>
        <div id="board" class="grid grid-cols-5 gap-4 mx-72 mt-12 justify-items-center">
            {{-- Kartu yang ditampilkan --}}
        </div>
        <div class="flex justify-center mt-2">
            <button id='start' class="bg-yellow-300 h-12 w-64 my-8 rounded text-xl hover:bg-yellow-100">Start Game</button>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    const cardlist = [
        { value: '1', image: 'images/2.png' },
        { value: '2', image: 'images/3.png' },
        { value: '3', image: 'images/4.png' },
        { value: '4', image: 'images/5.png' },
        { value: '5', image: 'images/6.png' },
        { value: '6', image: 'images/7.png' },
        { value: '7', image: 'images/8.png' },
        { value: '8', image: 'images/9.png' },
        { value: '9', image: 'images/10.png' },
        { value: '10', image: 'images/11.png' },
        { value: '1', image: 'images/2.png' },
        { value: '2', image: 'images/3.png' },
        { value: '3', image: 'images/4.png' },
        { value: '4', image: 'images/5.png' },
        { value: '5', image: 'images/6.png' },
        { value: '6', image: 'images/7.png' },
        { value: '7', image: 'images/8.png' },
        { value: '8', image: 'images/9.png' },
        { value: '9', image: 'images/10.png' },
        { value: '10', image: 'images/11.png' }
    ];

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
                <div class="card" id="${element.value}"> 
                     <div class="card-front">
                     <img src="${element.image}">   
                     </div>
                     <div class="card-back">
                         <img src="images/MainLogo.png">   
                     </div>
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
        if(firstCard.attr('id') === secondCard.attr('id')){
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
            $('#start').attr('disabled',false);
            $('h1').html("YOU WIN!!!");
        }
    }

    function lookTime(){
        $('#board').empty();
        match=0;
        shuffleCard();
        generateCard();
        $('h1').html("MATCH ME!");

        setTimeout(() => {
            cardlist.forEach(element => {            
            $('.card').addClass('flipped');
        });        
        $('#start').attr('disabled',true);

        }, 1000);
      
        setTimeout(() => {
            cardlist.forEach(element => {            
            $('.card').removeClass('flipped');   
        });
        $('.card').on('click', function () {
                cardClick($(this));
            });
        }, 60000);
    }
    
    
</script>
</html>