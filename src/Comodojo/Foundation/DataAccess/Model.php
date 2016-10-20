<?php namespace Comodojo\Foundation\DataAccess;

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


class Model {

    protected $data = array();

    public function __get($name) {

        if ( array_key_exists($name, $this->data) ) {

            return $this->data[$name];

        }

        return null;

    }

    public function __set($name, $value) {

        $this->data[$name] = $value;

    }

    public function __unset($name) {

        if ( isset($this->$name) ) unset($data[$name]);

    }

    public function __isset($name) {

        return array_key_exists($name, $this->data);

    }

    public function merge($data) {

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        return $this;

    }

    public function export() {

        return $this->data;

    }

    public function import($data) {

        $this->data = $data;

        return $this;

    }

}
