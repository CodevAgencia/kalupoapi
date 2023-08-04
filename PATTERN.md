
# About Pattern

<p>
    El manejo de modelos y acceso a base de datos asi como la logica de la aplicacion
    se extentien gracias al patron repository mediante contractos, estos deberan implementarse en los modelos con el fin de no utilizar los modelos dentro de los 
    controlladores, a su ves dejo una guia para retroalimentar <a href='https://medium.com/@cesiztel/repository-pattern-en-laravel-f66fcc9ea492'>repository-pattern-en-laravel</a>
</p>

## Estructure folders


<sub>

    /app
        /Contracts
        /Repositories

</sub>

## Steps

### Step Contracting model

<p>
    El primer paso a seguir es la creacion de la interfaz que define
    los metodos que tendra el contracto, seguir la convencion <i>UpperCamelCase</i> para
    el nombre de los archivos y clases. para el caso de una buena lectura
    de archivos debera haber un sufijo de nombre <b>Contract</b>, ejemplo UserContract.
</p>

```php

    <?php

    namespace App\Contracts\ModelContract;

    /**
    * @property int $id
    * @property string $column
    */

    interface ModelContract
    {
        public function setAttributes(array $data):void;

        public function destroyMe():void;

        public function getSubCategorias(): ?Enumerable;
    }

```

### Step Implementation

<p>
    Despues de haber generado la respectiva interfaz, pasaremos a implementar dicha
    interfaz en nuestro Modelo
</p>

```php

    <?php

    namespace App\Models;

    use App\Contracts\Model\ModelContract;
    use Illuminate\Database\Eloquent\Model;

    class Model extends Model implements ModelContract
    {

        /**
        * The attributes that are mass assignable.
        *
        * @var array<int, string>
        */
        protected $fillable = [
            'column',
        ];
        public function setAttributes(array $data):void;
        {
            $this->update($data);
        }

        public function getSubCategorias(): ?Enumerable;
        {
            return $this->subcategorys()->get();
        }

        public function destroyMe():void;
        {
            $this->delete();
        }
    }

```


### Step Contracting Service

<p>
    En inumerables casos nuestra logica de aplicacion sera dependiente de un model
    especifico por ende este debera tener su contracto y su respectivo service repository
    para la creacion de la interfaz de este muy similar a la del model de la siguiente manera.
</p>


```php
    
    <?php

    namespace App\Contracts\Model;

    interface ModelRepositoryContract
    {
        /**
        * Creates a new model.
        * @param array{column: string, column: string} $attributes
        */

        public function all():Enumerable;

        public function create(array  $data):void;

        public function find($id): ?Model;

    }

```

### Step Creating Repository

<p>
    Como se menciono en esos inmurables casos la logica de nuestra aplicacion depende
    de un modelo y para seguir el principio de <b>SOLID</b> y seperar la funciones en pequenos fragmentos asi como tener controlladores simples y poder reutilizar funciones de nuestros modelos en otros modulos usaremos este patron; Por esto es importante tener un repositorio que extrae las funciones logicas ya sea de interacion con la base de datos como de logica de nuestro modelo. 

    Creacion de nuestro respository
</p>


```php
    
    <?php

    namespace App\Repositories;

    use App\Contracts\Model\ModelContract;
    use App\Contracts\Model\ModelRepositoryContract;
    use App\Models\Model;

    /**
    * {@inheritDoc}
    *
    * @implements ModelRepositoryContract<Model>
    */
    class ModelRepository implements ModelRepositoryContract
    {
        public function create(array $attributes): ModelContract
        {
            $model = Model::create($attributes);

            return $model;
        }
    }

```

### Step Binding

<p>
    Despues de haber implementado nuestro contrato pasaremos a binderar el contracto con su respectivo modelo en el container de laravel o si por otro lado necesitas enlazar
    el contrato a tu repository se debera realizar el siguiente paso, depues de estos atraves de inyeccion de dependecinas o por llamado del container de laravel podras
    acceder a dichos contratos.
</p>

```php
<?php

    namespace App\Models;

    use App\Models\Model;
    use App\Contracts\Model\ModelContract;
    
    use App\Contracts\Model\ModelRepositoryContract;
    use App\Repositories\ModelRepository;

    use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
    {

        /**
        * Register services.
        */
        public function register(): void
        {
            $this->app->bind(ModelContract::class, Model::class);
            $this->app->bind(ModelRepositoryContract::class, ModelRepository::class);
        }
    }

```