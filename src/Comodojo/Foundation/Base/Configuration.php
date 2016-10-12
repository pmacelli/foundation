<?php namespace Comodojo\Foundation\Base;

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


class Configuration {

    protected $attributes = array();

    public function __construct( $configuration = array() ) {

        $this->attributes = array_merge($this->attributes, $configuration);

    }

    public function get($property = null) {

        if ( is_null($property) ) {

            return $this->attributes;

        } else if (array_key_exists($property, $this->attributes)) {

            $value = $this->attributes[$property];

            // substitution by backreference is cool but hard compute for a large set of values :(
            //
            // if ( is_scalar($value) && preg_match_all('/%(.+?)%/', $value, $matches, PREG_SET_ORDER) ) {
            //
            //     $substitutions = array();
            //
            //     foreach ( $matches as $match ) {
            //
            //         $backreference = $match[1];
            //
            //         if ( $backreference != $property && !isset($substitutions['/%'.$backreference.'%/']) ) {
            //
            //             $substitutions['/%'.$backreference.'%/'] = $this->get($backreference);
            //
            //         }
            //
            //     }
            //
            //     $value = preg_replace(array_keys($substitutions), array_values($substitutions), $value);
            //
            // }

            return $value;

        } else {

            return null;

        }

    }

    public function set($property, $value) {

        $this->attributes[$property] = $value;

        return $this;

    }

    public function has($property) {

        return isset($this->attributes[$property]);

    }

    public function isDefined($property) {

        return $this->has($property);

    }

    public function delete($property = null) {

        if ( is_null($property) ) {

            $this->attributes = array();

            return true;

        } else if ( $this->isDefined($property) ) {

            unset($this->attributes[$property]);

            return true;

        } else {

            return false;

        }

    }

    public function merge($properties) {

        $this->attributes = array_replace($this->attributes, $properties);

        return $this;

    }

}
