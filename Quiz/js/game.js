/*jslint browser: true*/
/*jslint plusplus: true */
/*global $, jQuery, numeral, alert*/

var quiz = {
    QuestionNumber : 0,
    Shuffle : function (array) {
        var m = array.length, t, i;
        
        while (m) {
            i = Math.floor(Math.random() * m--);
            
            t = array[m];
            array[m] = array[i];
            array[i] = t;
        }
        
        return array;
    },
    Expilsiur : function(){
        $("input").prop("checked", false);
    },
    Question : [
        {
            Q : "What is the capital of China?",
            A : ["Bejing", "Shanghai", "Budapest", "Hong Kong"],
            CA : 0,
            Correct : false
        },
        {
            Q : "What is the capital of Iceland?",
            A : ["Reykjavik", "Akureyri", "Selfoss", "Berlin"],
            CA : 0,
            Correct : false
        },
        {
            Q : "How many popes are there each square KM in the Vatican?",
            A : ["2.3", "1", "0.5", "0"],
            CA : 0,
            Correct : false
        },
        {
            Q : "What is the best way to burn a kitten?",
            A : ["Just light it on fire", "Pour water on it", "Do nothing", "Just no"],
            CA : 0,
            Correct : false
        },
        {
            Q : "Why would you burn a kitten?",
            A : ["You craycray", "It is fun", "I just", "Just no"],
            CA : 0,
            Correct : false
        }
    ],
    Contains : function (array, number) {
        var i = 0;

        for (i = 0; i < array.length; i++) {
            if (array[i] === number) {
                return true;
            }
        }

        return false;
    },
    usedAnswers : [],
    GetNextAnswer : function () {
        var thing = Math.floor(Math.random() * (quiz.Question.length - 1));
        while (quiz.Contains(quiz.usedAnswers, thing)) {
            thing = Math.floor(Math.random() * (quiz.Question.length - 1));
        }
        quiz.usedAnswers.push(thing);
        return thing;
    },
    ShowQuestion : function (number) {
        'use strict';
        
        $("#question").text(quiz.Question[number].Q);
        var current = quiz.GetNextAnswer();
        $("label[for=answer1]").text(quiz.Question[number].A[current]);
        $("#answer1").val(quiz.Question[number].A[current]);
        
        current = quiz.GetNextAnswer();
        $("label[for=answer2]").text(quiz.Question[number].A[current]);
        $("#answer2").val(quiz.Question[number].A[current]);
        
        current = quiz.GetNextAnswer();
        $("label[for=answer3]").text(quiz.Question[number].A[current]);
        $("#answer3").val(quiz.Question[number].A[current]);
        
        current = quiz.GetNextAnswer();
        $("label[for=answer4]").text(quiz.Question[number].A[current]);
        $("#answer4").val(quiz.Question[number].A[current]);
        
        quiz.usedAnswers = [];
    },
    FinishQuiz : function () {
        'use strict';
        var x,
            correctAnswers = 0;
        
        $("#question").text("Vuuu");
        $('input[name=answer]').remove();
        $('label').remove();
        $('#next').text("Again?");
        
        for (x in quiz.Question) {
            if (quiz.Question[x].Correct) {
                correctAnswers++;
            }
        }
        
        $('#message').text("You answered " + correctAnswers + " out of " + quiz.Question.length + " correctly");
    },
    AnswerQuestion : function (number) {        
        'use strict';
        
        var answer = $('input[name=answer]:checked').val();
        
        if (answer === quiz.Question[number].A[quiz.Question[number].CA]) {
            quiz.Question[number].Correct = true;
        }
        
        if (quiz.QuestionNumber < quiz.Question.length - 1) {
            quiz.QuestionNumber++;
        } else if (quiz.QuestionNumber == quiz.Question.length - 1) {
            quiz.FinishQuiz();
            quiz.QuestionNumber++;
        } else if (quiz.QuestionNumber > quiz.Question.length - 1) {
            quiz.NewGame();
        }
        
        quiz.Expilsiur();
        quiz.ShowQuestion(quiz.QuestionNumber);
    },
    NewGame : function () {
        'use strict';
        
        quiz.QuestionNumber = 0;
        quiz.Question = quiz.Shuffle(quiz.Question);
        quiz.ShowQuestion(quiz.QuestionNumber);
        quiz.Expilsiur();
    }
};
quiz.NewGame();