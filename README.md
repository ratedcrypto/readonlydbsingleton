# moodle remote db connector

This plugin creates a singleton db instance of provided db configs. It is **strictly** written to connect with **READONLY** db user of a **SLAVE** replica.  

moodle compatibility
--------------------

This plugin works on moodle 3.5+

installation
------------

1. Install this plugin into: ``<moodledir>/local/readonlydbsingleton``
2. Run upgrade

configuration
-------------

Please configure a **read only db user of a slave replica** and add it in ``config.php`` as follows:

Dummy db credentials:

    $CFG->remotedbhost    = 'db';
    $CFG->remotedbname    = 'moodle';
    $CFG->remotedbuser    = 'moodle_user';
    $CFG->remotedbpass    = 'P4ssW0rd';

initialisation & usage
----------------------

    \local_readonlydbinstance\remotedb::get_instance()->get_remotedb()->get_records_sql('SELECT * FROM {table}');
