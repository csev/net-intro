Introducción a las Redes
========================

Este es mi libro (en desarrollo) de introducción a la tecnología
de redes.


Puedes ver o descargar la última versión del libro en 
<a href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.pdf" target="_blank">PDF</a>
o
<a href="http://do1.dr-chuck.com/net-intro/EN_us/net-intro.epub" target="_blank">EPUB</a>
(actualizado cada hora)

Para crear el libro tú mismo, instala *pandoc* y ejecuta

    pandoc --default-image-extension=svg --epub-stylesheet=epub.css *.mkd -o x.epub

    pandoc --default-image-extension=svg *.mkd -o x.html

    pandoc -s -N --toc --default-image-extension=eps -V fontsize:11pt -V documentclass:book --template=template.latex *.mkd -o x.pdf 

O algún comando de pandoc similar.

También puedes obtener el pdf a través de LaTeX, usando

	sh book.sh
	
Ten en cuenta que el índice necesita dos pasadas.

También puedes generar archivos de audio con todos los capítulos en la carpeta
audio, usando

	sh audio.sh

Si usas un Mac.

Comprobación de ortografía:

    aspell -c 09-OSI.mkd

Las ilustraciones de este libro han sido creadas por Mauro Toselli
y Sue Blumenberg está realizando la edición de las copias.

Por favor, no reutilices nada de este material, ya que está aún en desarrollo.
El libro tiene los derechos de reproducción reservados por Charles R. Severance
(Copyright All Rights Reserved - Charles R. Severance)
y los derechos de reproducción de las figuras sketchnote corresponden a Mauro Toselli
(Copyright All Rights Reserved - Mauro Toselli).

Cuando el libro esté finalizado y publicado, pondré unos derechos de reproducción
más liberales para todo su contenido.
