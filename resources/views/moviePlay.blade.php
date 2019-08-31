<!-- This is only a test view -->
<object type="application/x-vlc-plugin" data="http://server.example.com/video1.mpeg" width="400" height="300" id="video1">
     <param name="movie" value="http://server.example.com/video1.mpeg"/>
     <embed type="application/x-vlc-plugin" name="video1"
     autoplay="no" loop="no" width="400" height="300"
     target="{{$movieFile}}" />
     <a href="{{$movieFile}}">Descargar vídeo</a>
</object>
