angular.
module('AppInfo', []);

angular.
module('AppInfo').
component('noticias', {
    template:  
    '<tr ng-repeat="phone in $ctrl.users">' +
        '<td><a href="#">#{{ noticia.getId() }}</a></td>' +
        '<td class="titulo">casa </td>'+
        '<td class="text-center">teste</td>'+
        '<td>'+
        '   <a href=""><span class="glyphicon glyphicon-pencil"></span></a>'+
        '    <a href=""><span class="glyphicon glyphicon-remove-sign"></span></a>'+
        '</td>'+
    '</tr>',
    controller: function GreetUserController() {
        this.user = ["casa","casa"];
        /*$.ajax('http://localhost/teste01/api/noticias/lista').then( function(listaNoticias)  {

        });*/

    }
});
