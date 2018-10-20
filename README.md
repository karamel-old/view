# View package for karamel
### Installation
1. You should define that constant variables
    ```php
   define('KM_VIEW_BASE_PATH','');
   define('KM_VIEW_DIST_PATH','');
   define('KM_VIEW_DELIMETER','');
    ```
2. You can get instance of `View` with `getInstance()` method
    ```php
   $view = \Karamel\View\View::getInstance();
    ```
    
### Helpers Method
1. `view($viewName,$variables)`
    > return compiled view to output
#### implemented commands
* [x] if
* [x] else
* [x] elseif
* [x] endif
* [x] for
* [x] endfor
* [x] foreach
* [x] endforeach
* [x] while
* [x] endwhile
* [x] break
* [x] continue
* [x] isset
* [x] endisset
* [ ] include
* [x] section
* [x] endsection
* [ ] extends
* [ ] yield
* [x] switch
* [x] case
* [x] endswitch
* [ ] push
* [ ] component