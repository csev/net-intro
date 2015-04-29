<html>
<head>
<title>Under Construction</title>
<?php require_once('head.php'); ?>
</head>
<body>
    <div class="container">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Net-Intro is under construction</h1>
        <p class="lead">This site is being built 
as a source of Open Educational Resources to support my upcoming textbook on 
TCP/IP network technologies.  
I am also exploring a completely new approach to bulding remixable 
OER materials.
You can watch this evolve in my 
<a href="https://github.com/csev/net-intro/commits/master" target="_blank">GitHub repository</a>.  
Feel free to submit a pull request if you find something 
that needs fixing.  Thanks in advance.</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>TextBook</h2>
          <p>There is a cool textbook under construction with nice
            sketchnote images.  When completed, it will be released
            under a CC-BY-NC license.</p>
          <p><a class="btn btn-primary" href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.pdf" target="_blank">PDF &raquo;</a>
          <a class="btn btn-primary" href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.epub" target="_blank">EPUB &raquo;</a>
          <a class="btn btn-primary" href="http://www-personal.umich.edu/~csev/books/net-intro/audio/" target="_blank">Audio &raquo;</a>
</p>
        </div>
        <div class="col-lg-4">
          <h2>Slides</h2>
          <p>The slides for the book will be produced using 
<a href="http://lab.hakim.se/reveal-js/#/" target="_blank">Reveal.JS</a>
and
<a href="http://csev.github.io/dazzleSketch/" target="_blank">DazzleSketch</a>.
For a fun time, Press CTRL-1 and hold down your mouse 
to scribble on the slides.</p>
          <p><a class="btn btn-primary" href="slides/index.php" role="button">View Sample Slides &raquo;</a>
          </p>
       </div>
        <div class="col-lg-4">
          <h2>Quizzes</h2>
          <p>Each chapter has end-of-chapter questions.  Those questions
are available as quizzes that can be taken online.
</p>
          <p><a class="btn btn-primary" href="quiz/" role="button">Take a Quiz &raquo;</a></p>
        </div>
      </div>

      <!-- Site footer 
      <footer class="footer">
        <center>
        </center>
      </footer> -->

<?php require_once('javascript.php'); ?>

<hr/>
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'net-intro';
    var disqus_shortname = 'net-intro';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</div>

</body>
