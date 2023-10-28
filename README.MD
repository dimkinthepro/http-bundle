# Request validation bundle for Symfony

### 1. Installation:
```bash
composer require dimkinthepro/http-bundle
```

### 2. Check bundles config:
```php
# config/bundles.php

return [
#...
    Dimkinthepro\Http\DimkintheproHttpBundle::class => ['all' => true],
];
```

### 3. Create bundle configuration:
```yaml
# config/packages/dimkinthepro_http.yaml

dimkinthepro_http:
    request_validation_enabled: true
    extra_fields_allowed: true
    handle_validation_errors: true
    response_error_format: json
```

### 4. Check validator config:
```yaml
# config/packages/validator.yaml

framework:
    #...
    validation:
        #...
        mapping:
            paths:
                #...
                - '%kernel.project_dir%/config/validator/'
```

### 5. Create a controller DTO:
```php
# src/App/DTO/RequestDTO.php

namespace App\DTO;

use Dimkinthepro\Http\Domain\DTO\ValidatedDTOInterface;

class RequestDTO implements ValidatedDTOInterface
{
    public string $method;
    public int $parameter;
}
```

### 6. Create a validation config for DTO:
```yaml
# config/validator/RequestDTO.yaml

App\DTO\RequestDTO:
  properties:
    method:
      - NotBlank: ~
    parameter:
      - NotBlank: ~
      - GreaterThan: 0
      - LessThanOrEqual: 255
```

### 7. Use validated DTO in your controller:
```php
# src/App/Controller/Controller.php

namespace App\Controller;

use App\DTO\RequestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends AbstractController
{
    public function __invoke(RequestDTO $DTO): JsonResponse
    {
        return new JsonResponse([
            'method' => $DTO->method,
            'parameter' => $DTO->parameter,
        ]);
    }
}
```
