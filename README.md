# Laravel Outcome Outmess

This package allows you to add messages depending on the outcome of processes, such as updating a user or deleting a menu item. Then you may retrieve all those messages at once and format them in HTMl according to the configuration you have set, which may depend, for instance, on the UI framework you are using.

## Installation

Add the following to your ```composer.json``` file:

```
"require": {
  ...
  "knifecake/outmess": "1.0.x"
},
````

Add the following to your Service Provider array in Laravel's ```app/config/app.php```:

```
  ...
  'Knifecake\Outmess\OutmessServiceProvider',
```

And this under the ```aliases``` array:

```
  ...
  'Outmess' => 'Knifecake\Outmess\Facades\Outmess',
  ...
```

If you want to preserve messages for one more request (i.e. flashing them). Add this to your after filter in the ```filters.php``` file:

```
	Outmess::flash();
```

## Setting up a new style

Styles are used to render your messages when you call ```Outmess::render()```. All styles are present in the config file inside the ```styles``` array. Every style consists of one or more message types that correspond to the name of the method you use to add a message. Therefore, to set an error message you may call ```Outmess::error($message)``` and define that message type inside your style using the key ```message```. Here is an example of a style definition:

```
'styles' => array(
  'style-name' => array(
    'message-type-1' => '<p>Message format string 1, always containing :message</p>',
    ...
    'message-type-n' => '<p>Message format string n, always containing :message</p>',
  ),
),

```

## Chosing which style to use

To chose what style you want to use change the 'style' config value to the name of that style you wish to use, as long as it is defined inside the styles array. You may also change the style you are using at runtime by calling ```Outmess::style('new-style')```. Notice the style you set will affect all the messages you have already added if any.

## Outputting the messages

To output your messages using the style you have chosen call ```Outmess::render()```. This method outputs a string of HTML so it may be called on a view, for example atop a page. If you did not add any messages this method won't output anything so no worries if you call it without checking first.

## Contributing and reporting bugs

Want a new feature? Something wrong? Any questions? Head to https://github.com/knifecake/outmess and make a pull request or create a new issue.
