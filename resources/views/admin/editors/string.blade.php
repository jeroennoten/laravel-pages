<input type="text"
       name="{{ $name }}"
       value="{{ old($name, $content) }}"
       class="form-control"
       style="{{ $config['css'] or ''}}"
>