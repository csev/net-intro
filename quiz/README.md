How to update the quiz questions
--------------------------------

The answers in quizzes.json are encoded using two values from 
config.php in the main folder:

    // Choose two prime numbers between 100 and 10000
    // If you change these you will lose all your encoded
    // answers when you run quiz/parse.py
    $answer_suffix = 783;
    $answer_factor = 791;

You need to match these in your dev environment and hosting
environment.

To make a change, first decode the answers:

    python3 parse.py

This makes a copy of `quizzes.json` into `quiz_new.json` 
decoding all the answers.

Then edit `quiz_new.json` and copy it back to `quizzes.json`
and run

    python3 parse.py encode


Then copy `quiz_new.json` with the encoded answers back to `quizzes.json`.

I might make this a bit easier if I think about it - but that
is the process for now.

