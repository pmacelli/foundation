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

trait ParametersTrait {

    protected $parameters = [];

    public function get($parameter=null) {

        if ( is_null($parameter) ) return $this->parameters;

        return array_key_exists($parameter, $this->parameters) ?
            $this->parameters[$parameter] : null;

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

    }

    public function set($parameter, $value) {

        $this->parameters[$parameter] = $value;

        return $this;

    }

    public function has($parameter) {

        return isset($this->parameters[$parameter]);

    }

    public function delete($parameter = null) {

        if ( is_null($parameter) ) {

            $this->parameters = [];

            return true;

        } else if ( array_key_exists($parameter, $this->parameters) ) {

            unset($this->parameters[$parameter]);

            return true;

        } else {

            return false;

        }

    }

}
