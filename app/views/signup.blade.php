<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign-Up: A Laravel Form</title>
    <style>
        label {
            display: block;
            padding-top: 1em;
        }
        input[type="submit"] {
            display: block;
            margin-top: 2em;
        }
        textarea {
            display: block;
            margin-bottom: 1em;
        }
        input[type="checkbox"] {
            display: inline-block;
            margin-top: 1em;
        }
        label[for="agree"] {
            display: inline;
        }
        .mytext{
            font-size: 60px;
        }

    </style>
</head>

<body>
<h1>Newsletter sign up</h1>
{{Form::open(array('url' => 'thanks'))}}
    {{Form::label('email', 'Email Address')}}
    {{Form::text('email', '', array('type' => 'password'))}}

    {{Form::label('os', 'Operating System')}}
    {{Form::select('os', array(
        'linux' => 'Linux',
        'mac' => 'Macintosh OS X',
        'windows' => 'Windows'
        ))}}

    {{Form::label('comment', 'Comments')}}
    {{Form::textarea('comment', '', array('placeholder' => 'What are your interests?'))}}

    {{Form::checkbox('agree', 'Yes', true)}}
    {{Form::label('agree', 'I agree to your terms')}}

    {{Form::submit('Sign Up')}}
{{Form::close()}}
</body>
</html>