Introduction to Networking
==========================

This is my under-development book on introduction to network
technology.  

You can view or view the latest version of the book in 
<a href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.pdf" target="_blank">PDF</a>
or
<a href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.epub" target="_blank">EPUB</a>
(rebuilt hourly)

To produce the PDF of the book, you will need to install LaTeX on your 
system.  For Linux:

    apt-get install texlive-full
    apt-get install pandoc

For Macintosh,

    https://www.tug.org/mactex/
    https://www.tug.org/mactex/mactextras.html
    
    https://pandoc.org/installing.html#macos

To build the book yourself, run

    pandoc --default-image-extension=svg --epub-stylesheet=epub.css *.mkd -o x.epub

    pandoc --default-image-extension=svg *.mkd -o x.html

    pandoc -s -N --toc --default-image-extension=eps -V fontsize:11pt -V documentclass:book --template=template.latex *.mkd -o x.pdf 

Or some similar pandoc command.

You can also run the pdf through LaTeX using 

	sh book.sh

Since the index requires two passes.

You can also generate audio readings of all of the chapters in the audio folder
using 

	sh audio.sh

If you are on a Mac.

Spell checking:

    aspell -c 09-OSI.mkd

The illustrations for this book are being developed by Mauro Toselli
and Sue Blumenberg is doing copy editing.

While this is under development, please do not reuse any of this material.
The book is Copyright All Rights Reserved - Charles R. Severance and the 
sketchnote figures are Copyright All Rights Reserved - Mauro Toselli.

When the book is completed and published we will put a more liberal copyright
on all of the materials.
