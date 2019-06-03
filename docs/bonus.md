## Bonus

O projeto da Api vai com um pequeno "Bonus" um gerador de Crud feito por mim Dário Santos. O gerador é bem simples, segue abaixo.

#### Usando o gerador:
```
# Usando o artisan gere um crud completo (controller, request, rule, service, repository, model e rotas), com o comando.
$ php artisan crud:generate Cars/Cars --attributes=nome --attributes=nome --table-name=cars

ou Gere os componentes especificos que você desejar.

# Gerando controller
$ php artisan crud:controller Cars/Cars

# Gerando requests
$ php artisan crud:request Cars/Cars --attributes=nome --attributes=marca

# Gerando service
$ php artisan crud:service Cars/Cars

# Gerando repository
$ php artisan crud:repository Cars/Cars

# Gerando model
$ php artisan crud:model Cars --attributes=nome --attributes=marca --table-name=cars

# Gerando migration
$ php artisan crud:migration Cars --attributes=nome --attributes=marca --table-name=cars
```
