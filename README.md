# sistema-atelie_v2

<img src="public\img\live-demo\dona-nalva.gif" alt="My Project GIF" width="auto" height="500">
 
<ol>
  <li>Crie um arquivo .env na raiz do projeto com base no arquivo .env.example e configure suas variáveis de ambiente.</li>
  <li><code>docker-compose up -d --build</code> para iniciar o ambiente de desenvolvimento.</li>
  <li><code>docker-compose exec rede-fornecedores-app composer install</code> </li>
  <li><code>docker-compose exec rede-fornecedores-app php artisan key:generate</code> </li>
  <li><code>docker-compose exec rede-fornecedores-app php artisan migrate</code> </li>
  <li><code>docker-compose exec rede-fornecedores-app php artisan db:seed</code> </li>
  <li><code>docker-compose exec rede-fornecedores-app php artisan optimize</code> </li>
  <li>Acesse o aplicativo em seu navegador em <a href="http://localhost:8080/">http://localhost:8080/</a>.</li>
</ol>