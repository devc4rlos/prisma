## Summary

<!-- Breve resumo em alto nível (1 a 3 frases) explicando o objetivo e o valor entregue por este PR. -->

## What changed

- **[Módulo / Camada 1]**: <!-- Descrição sucinta das alterações feitas nesta camada ou arquivo -->
  - <!-- Detalhe técnico / sub-item -->
  - <!-- Detalhe técnico / sub-item -->
- **[Módulo / Camada 2]**: <!-- Descrição sucinta das alterações -->
  - <!-- Detalhe técnico / sub-item -->
- **Frontend / UI**: <!-- Alterações visuais, novos componentes, rotas, hooks, etc. -->
  - <!-- Detalhe técnico / sub-item -->
- **Tests**: <!-- Resumo do que foi adicionado ou atualizado nos testes -->

## Implementation notes

- <!-- Decisões de arquitetura, padrões utilizados (ex: DDD, DTOs, Enums, Contracts) ou trade-offs. -->
- <!-- Tratamento de exceções, isolamento de escopo ou abstrações criadas. -->
- <!-- Detalhes do contrato de dados ou fluxo entre frontend e backend. -->

## Testing

- `vendor/bin/pest` (ou `php artisan test --compact`): **XX passed, YY assertions**.
- `tests/Feature/ExampleTest.php` (novo/atualizado): <!-- Breve lista dos cenários cobertos nos testes automatizados. -->

## Quality validation

- **Laravel Pint** (`vendor/bin/pint --test`): passed.
- **Larastan / PHPStan** (`vendor/bin/phpstan analyse`): passed, level XX, 0 errors.
- **Pest** (`vendor/bin/pest`): XX passed.
- **`npm run build`** (frontend/assets build): passed.

## Security considerations

- <!-- Validações, sanitização de dados, autorizações, rotas públicas/protegidas, rate limits ou proteção de chaves/segredos. -->

## Performance considerations

- <!-- Concorrência, queries otimizadas, uso de cache, requisições assíncronas, debounce ou cancelamento de chamadas. -->

## Breaking changes / migration

- <!-- Nenhuma / Ou detalhamento de migrations executadas, novos contratos de API, variáveis de ambiente novas (.env.example), etc. -->

## Reviewer attention

- <!-- Pontos específicos onde o revisor deve focar a atenção (ex: bordas de validação, limites de taxa, acessibilidade da UI, contrato de erro). -->
