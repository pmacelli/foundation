<?php namespace Comodojo\Foundation\Base;

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

trait ConfigurationParametersTrait {

    protected $parameters = [];

    public function get($parameter=null) {

        if ( is_null($parameter) ) return $this->parameters;

        return $this->getFromParts(self::splitParts($parameter));

    }

    public function set($parameter, $value) {

        $parts = self::splitParts($parameter);

        if ( empty($parts) ) throw new InvalidArgumentException("Invalid parameter $parameter");

        $this->setFromParts($parts, $value);

        return $this;

    }

    public function has($parameter) {

        return is_null($this->getFromParts(self::splitParts($parameter))) ? false : true;

    }

    public function delete($parameter = null) {

        if ( is_null($parameter) ) {

            $this->parameters = [];
            return true;

        }

        $parts = self::splitParts($parameter);

        if ( empty($parts) ) throw new InvalidArgumentException("Invalid parameter $parameter");

        return $this->deleteFromParts($parts);

    }

    protected function getFromParts(array $parts) {

        if ( empty($parts) ) return null;

        $reference = &$this->parameters;

        foreach ($parts as $part) {

            if ( !isset($reference[$part]) ) {
                return null;
            }

            $reference = &$reference[$part];

        }

        $data = $reference;

        return $data;
        //
        // $data = $this->parameters;
        //
        // foreach ($parts as $part) {
        //
        //     if ( isset($data[$part]) ) {
        //         $data = $data[$part];
        //     } else {
        //         return null;
        //     }
        //
        // }
        //
        // return $data;

    }

    protected function setFromParts(array $parts, $value) {

        $reference = &$this->parameters;

        foreach ($parts as $part) {

            if ( !isset($reference[$part]) ) {
                $reference[$part] = [];
            }

            $reference = &$reference[$part];

        }

        $reference = $value;

        return true;

    }

    protected function deleteFromParts(array $parts) {

        $reference = &$this->parameters;
        $l = count($parts);

        for ($i=0; $i < $l; $i++) {
            if ( !isset($reference[$parts[$i]]) ) {
                return false;
            }
            if ($i == $l-1) {
                unset($reference[$parts[$i]]);
            } else {
                $reference = &$reference[$parts[$i]];
            }
        }

        return true;

    }

    protected static function splitParts($parameter) {

        return preg_split('/(\s)?\.(\s)?/', $parameter, null, PREG_SPLIT_NO_EMPTY);

    }

}
