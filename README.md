# sf4-gothinkster - Custom 'Real World Example'


Repository di testing/discovery per la nuova versione di Symfony e nuovi componenti.

Il dominio dell'applicazione si basa sulle specifiche del progetto ['Real World Example']('https://github.com/gothinkster/realworld'),
specifiche usate esclusivamente come linee guida e/o feature da implementare in caso di attinenza con la reale TODO list del repo.





# TODO Testing (Concept/pattern/implementazioni)

- Value Object with Identity (write side)
- Value Object compositi implementare persistenza multifield
- Separare la conf. doctrine da Sf "per quanto possibile"(goal: Riuso/Scorporo Servizi, Bounded Context, o altro Framework)



# TODO Discovery


### Symfony/messanger a.k.a sf-m

- install configurazione sync/async
- implementare serviceBus solo con sf-m
  - CommandBus command pattern
  - EventBus
  

### Symfony/workflow a.k.a sf-w

install & conf
caso d'uso???? inventa... le idee di merda non mancano mai!    