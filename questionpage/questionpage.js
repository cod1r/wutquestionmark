document.getElementById('answerButton').onclick = function showAnswerBox(){
    document.getElementById('answerArea').style.display = 'block';
    document.getElementById('answerButton').style.display = 'none';
}

document.getElementById('answerNot').onclick = function disappear(){
    document.getElementById('answerArea').style.display = 'none';
    document.getElementById('answerButton').style.display = 'inline';
}