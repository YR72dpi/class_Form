# Class Form php

This class was made to create a form with label and some others options easier, with php.

```php
$form = new Form([
            "pseudo"=>[
                "type" => "text",
                "value" => "",
                "placeholder" => "Pseudo",
                "label" => "Votre pseudo : ",
                "required" => true
            ],
            "mdp"=>[
                "type" => "password",
                "value" => "",
                "placeholder" => "Mot de passe",
                "label" => "Votre mot de passe :",
                "required" => true
            ],
            "text"=>[
                "type" => "textarea",
                "value" => "",
                "placeholder" => "texte",
                "label" => "Commentaire"
            ],
            "check"=>[
                "type" => "checkbox",
                "value" => "1",
                "placeholder" => "texte",
                "label" => "CGU : ",
                "required" => true
            ],
            "music"=>[
                "type" => "file",
                "label" => "Fichier : ",
                "others" => "multiple"
            ],
            ""=>[
                "type" => "submit",
                "value" => "Envoyer",
                "placeholder" => "",
                "label" => ""
            ]
        ]);
        
        $form->getForm();
```

And you can get the form values in an array with
```php
$form->getValue()
```

## setAutoClose() & getCloser()
If you want, you can let the form tag open ("< /form >" not print), write you own code and close it after.

But by default, getForm() auto close the form tag. To prevent it, you have to write :
```php
$form->setAutoClose(false);
```
After, generate your form :
```php
$form = new Form([
            // your form param
        ]);
        
$form->getForm();
```
Write your own code in the form : 
```html
    <!-- your own code -->
```
To finish, close the form tag:
```php
$form->getCloser();
```