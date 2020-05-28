document.getElementById('answerButton').onclick = function showAnswerBox(){
    document.getElementById('answerArea').style.display = 'block';
    document.getElementById('answerButton').style.display = 'none';
}

document.getElementById('answerNot').onclick = function disappear(){
    document.getElementById('answerArea').style.display = 'none';
    document.getElementById('answerButton').style.display = 'inline';
}


document.getElementById('submitQuestion').onclick = function refreshAnswers(){
    var xmlhttp = new XMLHttpRequest ();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('answers').innerHTML = this.response.getElementById('answers').innerHTML;
            window.location.reload();
        }
    }
    xmlhttp.open("GET", "questionpage.php?question="+document.getElementById('TheQuestion').innerHTML,true);
    xmlhttp.responseType = 'document';
    xmlhttp.send();
}

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}