document.getElementById('answerButton').onclick = function showAnswerBox(){
    document.getElementById('answerArea').style.display = 'block';
    document.getElementById('answerButton').style.display = 'none';
}

document.getElementById('answerNot').onclick = function disappear(){
    document.getElementById('answerArea').style.display = 'none';
    document.getElementById('answerButton').style.display = 'inline';
}


function refreshAnswers(){
    var xmlhttp = new XMLHttpRequest ();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var parser = new DOMParser();
            document.getElementById('answers').innerHTML = parser.parseFromString(this.responseText, "text/html");
        }
    }
    xmlhttp.open("GET", "questionpage.php?question="+document.getElementById('TheQuestion').innerHTML,true);
    xmlhttp.send();
}

// setInterval(refreshAnswers, 5000);