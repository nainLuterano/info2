{% extends 'layouts/index.volt' %}

    {% block content %}

        <div id="cadastro_ticket" class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-plus"></i>
                        &nbsp;Editar Noticia
                    </div>
                    {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar') }}
                        
                        <div class="panel-body">
                            <div class="col-md-12"  id="conteudo">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <p><strong>Data de Criação:</strong> {{ noticia.get('data_cadastro')  }} </p>
                                                <p><strong>Data da Última Atualização:</strong> {{ noticia.get('data_ultima_atualizacao')  }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Titulo">Título <span class="error">(*)<span></label>
                                                {{ hidden_field("id", "value": noticia.get('id'), "class": 'form-control display-none') }}                                                    
                                                {{ text_field("titulo", "value": noticia.get('titulo'), 'required':true ,"width": '100%', "class": 'form-control') }}
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Publicar</label>
                                                {{ check_field('publicado', 'id':'publicar') }}
                                            </div>
                                        </div>

                                        <div class="row" id="data_publicacao" style="display: none;">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Data Publicação</label><br />
                                                {{ date_field('input_data_publicacao', 'value': noticia.get('data_publicacao')) }}
                                            </div>
                                        </div>                                        

                                        
                                        <div class="row" id="data_publicacao" style="display: none;">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Data Publicação</label><br />
                                                {{ date_field('input_data_publicacao') }}
                                            </div>
                                        </div>        

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Categorias</label><br />
                                                {{ select('categorias[]', categorias, 'using': ["id", "nome"], 'multiple': true, 'required': true) }}
                                            </div>
                                        </div>        
                                        
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Texto</label>
                                                {{ text_area("texto", "maxlength" :'255', "class": 'form-control tinymce-editor',"value":noticia.get('texto')) }}
                                            </div>
                                        </div>
                                        

                                    </div>{#/.panel-body#}
                                </div>{#/.panel#}
                                <div class="row" style="text-align:right;">
                                    <div id="buttons-cadastro" class="col-md-12">
                                        <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                                        {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                                    </div>
                                </div>
                            </div>{#/.conteudo#}
                        </div>{#/.panel-body#}
                    {{ end_form() }}
                </div>{#/.panel#}
            </div>{#/.col-md-12#}
        </div><!-- row -->

    {% endblock %}

    {%  block extrafooter %}
        
        <script>
            $(document).ready(function(){
                $('#publicar').on('click', function () {
                    const display = $("#data_publicacao").css('display') == 'none' ? 'block':'none';
                     $("#data_publicacao").css('display', display);
                     $("#input_data_publicacao").attr('name', display == 'block' ? 'data_publicacao': '');
                });

            });
        </script>
    {% endblock %}
