<?php
Configure::load('CakeCron.config');

App::uses('CakeCronEvent', 'CakeCron.Event');
App::uses('CakeCronListener', 'CakeCron.Event');
App::uses('CakeCronEventManager', 'CakeCron.Event');
