<?php
function loadTemplate($fileName, $templateVars): bool|string
{
	   extract($templateVars);
        ob_start();
        require $fileName;
       return ob_get_clean();
}

