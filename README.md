# Class Form php

This class was made to create a form with label and some others options easier, with php.

```php
$form = new Form([
            "pseudo"=>[
                       "type" => "text",
                      "value" => "",
                "placeholder" => "Pseudo",
                      "label" => "Votre pseudo : "
            ],
            "mdp"=>[
                       "type" => "password",
                      "value" => "",
                "placeholder" => "Mot de passe",
                      "label" => "Votre mot de passe :"
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
                "label" => "CGU : "
            ],
            "mus"=>[
                "type" => "file",
                "value" => "",
                "placeholder" => "",
                "label" => "Fichier ",
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