#Rate Limiter 

## What a rate limiter can do?

- Limit the api request frequency.


## Deep Further

### Simple Counter: 
Limit the api just based on a simple counter, whether can be realized by the memory or the cache component.
But when the counter is being utilized in the fpm, a persistent storage is required, because the fpm will clear the memory after the request finishes.
### Counter with Rolled Window
With the roll window mechanism, the new Counter can be more flexible with the burst incoming requests.
