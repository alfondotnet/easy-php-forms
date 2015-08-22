# Easy PHP Forms

This is a dumb project I initially coded for a task.
To get my hands dirty with PHP and Slim Framework, this setting was explored.
comments appreciated.

# Todo:

- Remove the hardcoded MySQL schema (obviously) and normalize the database properly
- Refactor everything properly
- Make a simple installation 
- User password configuration / reminder


# Dev Env Setup instructions:

1. Clone the repository
2. `vagrant up`
3. `vagrant ssh`
4. `mysql -u forms -pforms forms < forms.sql`
5. Go to http://127.0.0.1:9079 on host and that should be it

6. Lookup *config.php*

Password for the web interface: 

root / root