const app = angular.module('AppInfo', []);

app.controller('MainCtrl', function($scope, $http) {
    $http.get('http://localhost/teste01/api/noticias/lista')
    .then( function( response)  {
        $scope.url_update = response.data['url_update'];
        $scope.url_excluir = response.data['url_excluir'];
        $scope.noticias = response.data['noticias'];
     })
        
    console.log($scope.noticias);
});


angular.module('AppInfo').
component('noticias', {
    template:  `
    <table id="lista-noticia" class="table dataTable table-hover" >
    <thead>
        <tr>
            <td>Cod</td>
            <td>Titulo</td>
            <td>Texto</td>
            <td>Ações</td>
        </tr>
    </thead>
    <tbody ng-controller="MainCtrl">
    <tr  ng-repeat="noticia in noticias">
        <td><a href="#">#{{ noticia.id }}</a></td>
        <td class="titulo"> {{ noticia.titulo }}</td>
        <td class="text-center">{{ noticia.texto }}</td>
        <td>
            <a href="{{url_update}}{{noticia.id}}"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="{{url_excluir}}{{noticia.id}}"><span class="glyphicon glyphicon-remove-sign"></span></a>
        </td>
    </tr>

    </tbody>
</table>`
});


