/**
 * Config file with base variables.
 *
 * To load variables into file just include this file. e.g.
 *
 * var config = require('./config');
 * econsole.log(config.src);
 */

/**
 * Base variables
 *
 * Path relative to path where gulp is executed. Probably root directory
 */
let root = '.';
let src = './assets';
let dist = '.';

let config = {
    root,
    src,
    dist
};

export default config;
