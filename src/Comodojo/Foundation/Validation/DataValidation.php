<?php namespace Comodojo\Foundation\Validation;

use \UnexpectedValueException;
use \InvalidArgumentException;

/**
 * @package     Comodojo Foundation
 * @author      Marco Giovinazzi <marco.giovinazzi@comodojo.org>
 * @license     MIT
 *
 * LICENSE:
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Validation {

    const STRING = 'STRING';
    const REGEX = 'STRING';
    const BOOL = 'BOOL';
    const BOOLEAN = 'BOOL';
    const INT = 'INT';
    const INTEGER = 'INT';
    const NUMBER = 'NUMBER';
    const DOUBLE = 'DOUBLE';
    const FLOAT = 'FLOAT';
    const JSON = 'JSON';
    const SERIALIZED = 'SERIALIZED';

    private $supported_types = array (
        "STRING" => 'self::validateString',
        "REGEX" => 'self::validateRegex',
        "BOOL" => 'self::validateBoolean',
        "BOOLEAN" => 'self::validateBoolean',
        "INT" => 'self::validateInteger',
        "INTEGER" => 'self::validateInteger',
        "NUMBER" => 'self::validateNumeric',
        "DOUBLE" => 'self::validateFloat',
        "FLOAT" => 'self::validateFloat',
        "JSON" => 'self::validateJson',
        "SERIALIZED" => 'self::validateSerialized'
    );

    public static function validate($data, $type, $filter=null) {

        $type = strtoupper($type);

        if ( !array_key_exists($type, $this->supported_types) ) {
            throw new UnexpectedValueException("Bad validation type");
        }

        if ( call_user_func($this->supported_types[$type], $data, $filter) === false ) {
            throw new InvalidArgumentException("Bad value $data for a $type");
        }

        return true;

    }

    public static function validateString($data, $filter=null) {
        return is_string($data);
    }

    public static function validateRegex($data, $filter=null) {
        return preg_match($filter, $data);
    }

    public static function validateBoolean($data, $filter=null) {
        return is_bool($data);
    }

    public static function validateInteger($data, $filter=null) {
        return is_int($data);
    }

    public static function validateNumeric($data, $filter=null) {
        return is_numeric($data);
    }

    public static function validateFloat($data, $filter=null) {
        return is_float($data);
    }

    public static function validateJson($data, $filter=null) {
        $decoded = json_decode($data);
        return !is_null($decoded);
    }

    public static function validateSerialized($data, $filter=null) {
        $decoded = unserialize($data);
        return ($decoded == serialize(false) || $decoded !== false);
    }

}
