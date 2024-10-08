<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATCH ME! GAMES</title>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
      @vite('resources/css/app.css')
      <style>
        @import url('https://fonts.cdnfonts.com/css/sancreek');
        .card{
            height:200px;
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
            height: 100%;
            width: 100%;     
        }
            
        .card-back{
            background-color:#F6F7D7;
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
        
        #timer{
            font-size: 3em;
            font-family: 'Sancreek', sans-serif;
            color: #390203;
            text-align: center;
            position: fixed;
            top: 1rem;
            right: 2rem;
            width: 8rem;
            height: 3rem;
        }

        .hidden{
            display: none;
        }
      </style>
</head>
<body style="background-color: #EAE2B7">
    <div id="timer" >05:00</div>
    <div class="mx-auto h-500px">
        <p class="text-5xl font-bold left-2"></p>
        <h1 class="text-center text-5xl font-bold my-8" style="font-family: 'Sancreek', sans-serif; color:#390203; ">MATCH ME!</h1>
        <div id="board" class="grid grid-cols-5 gap-4 mx-72 mt-12 justify-items-center">
            {{-- Kartu yang ditampilkan --}}
        </div>
        <div class="flex justify-center mt-2">
            <button id='start' class="bg-red-800 h-12 w-64 my-8 rounded text-xl text-slate-100 hover:bg-red-400" style="font-family: 'Sancreek', sans-serif;">Start Game</button>
            
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    const cardlist = [
        { value: '1', image: 'images/Front0.png' },
        { value: '2', image: 'images/Front1.png' },
        { value: '3', image: 'images/Front2.png' },
        { value: '4', image: 'images/Front3.png' },
        { value: '5', image: 'images/Front4.png' },
        { value: '6', image: 'images/Front5.png' },
        { value: '7', image: 'images/Front6.png' },
        { value: '8', image: 'images/Front7.png' },
        { value: '9', image: 'images/Front8.png' },
        { value: '10', image: 'images/Front9.png' },
        { value: '1', image: 'images/Front0.png' },
        { value: '2', image: 'images/Front1.png' },
        { value: '3', image: 'images/Front2.png' },
        { value: '4', image: 'images/Front3.png' },
        { value: '5', image: 'images/Front4.png' },
        { value: '6', image: 'images/Front5.png' },
        { value: '7', image: 'images/Front6.png' },
        { value: '8', image: 'images/Front7.png' },
        { value: '9', image: 'images/Front8.png' },
        { value: '10', image: 'images/Front9.png' },
    ];

    let firstCard,secondCard;
    let lockBoard = false;
    let match = 0;
    let timerIsOn = false;

    $(document).ready(function () {
        shuffleCard();
        generateCard();
    });

    $('#start').click(function () { 
        lookTime();
        startTimer(300, document.querySelector('#timer'));
        $('#start').addClass('hidden');
    }); 

    function generateCard(){
        cardlist.forEach(element => {
            const card = `
            <div class="card" id="${element.value}"> 
                <div class="card-front">
                <img src="${element.image}">   
                </div>
                <div class="card-back">
                    <img src="images/Back.png">   
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

        // setTimeout(() => {
        //     cardlist.forEach(element => {            
        //         $('.card').addClass('flipped');
        //     });        
        //     $('#start').attr('disabled',true);
        // }, 1000);
    
        // setTimeout(() => {
        //     cardlist.forEach(element => {            
        //         $('.card').removeClass('flipped');   
        //     });
        // }, 60000);

        $('.card').on('click', function () {
                cardClick($(this));
            });
    }

    function startTimer(duration, display) {
        let timer = duration, minutes, seconds;
        lockBoard = false;
        if(timerIsOn){
            return;
        }
        timerIsOn = true;
        const interval = setInterval(() => {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;
            --timer

            if (timer < 0) {
                display.textContent = "00:00";
                clearInterval(interval);
                alert('Waktu Habis');
                lockBoard = true;
                timerIsOn = false;
                $('#start').removeClass('hidden');
            }

            if (match == 10){
                clearInterval(interval);
                lockBoard = true;
                timerIsOn = false;
                $('#start').removeClass('hidden');
            }
        }, 1000);
    }
    
</script>
</html>