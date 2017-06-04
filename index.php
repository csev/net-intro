<html>
<head>
<title>Introduction to Networking: How the Internet Works</title>
<?php require_once('head.php'); ?>
</head>
<body>
    <div class="container">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Introduction to Networking: How the Internet Works</h1>
        <p class="lead">This site is being built 
as a source of Open Educational Resources to support my 
<a target="_new" href="http://www.amazon.com/gp/product/1511654945/ref=as_li_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=1511654945&linkCode=as2&tag=drchu02-20&linkId=LUI4PZVNIMWUGOGS">textbook</a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=drchu02-20&l=as2&o=1&a=1511654945" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
on TCP/IP network technologies.  
I am also exploring a new approach to bulding remixable 
OER materials.
You can see the course code for the book in my 
<a href="https://github.com/csev/net-intro/commits/master" target="_blank">GitHub repository</a>.  
Feel free to submit a pull request if you find something 
that needs fixing.  Thanks in advance.</p>
        <span style="float:right">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
        </span>
</div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>TextBook</h2>
          <p>There is a cool textbook with 
            sketchnote images by Mauro Toselli.  Electronic copies are free with a CC-BY
             license and the print copy is CC-BY-NC.</p>
          <p><a class="btn btn-primary" href="http://do1.dr-chuck.net/net-intro/EN_us/net-intro.pdf" target="_blank">PDF &raquo;</a>
          <a class="btn btn-primary" href="http://do1.dr-chuck.net/net-intro/EN_us/net-intro.epub" target="_blank">EPUB &raquo;</a>
          <a class="btn btn-primary" href="http://www-personal.umich.edu/~csev/books/net-intro/audio/" target="_blank">Audio &raquo;</a>
<a class="btn btn-primary" href="http://www.amazon.com/gp/product/1511654945/ref=as_li_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=1511654945&linkCode=as2&tag=drchu02-20&linkId=LUI4PZVNIMWUGOGS">Amazon &raquo;</a><img src="http://ir-na.amazon-adsystem.com/e/ir?t=drchu02-20&l=as2&o=1&a=1511654945" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
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

      <footer class="footer">
        <center>
<p>If you find this material interesting you might be interested in 
taking my related course, 
"<a href="https://www.coursera.org/learn/insidetheinternet" 
target="_blank">Internet History, Technology, and Security</a>" available on 
Coursera.</p>
        </center>
      </footer> 

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
