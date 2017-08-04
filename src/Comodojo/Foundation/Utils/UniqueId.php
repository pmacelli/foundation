<?php namespace Comodojo\Foundation\Utils;

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

class UniqueId {

    public static function generate($length=128) {

        if ($length == 128) {

            return self::getUid();

        } else if ($length < 128) {

            return substr(self::getUid(), 0, $length);

        } else {

            $numString = (int)($length/128) + 1;
            $randNum = "";
            for ($i = 0; $i < $numString; $i++) $randNum .= self::getUid();

            return substr($randNum, 0, $length);

        }

    }

    protected static function getUid() {

        return md5(uniqid(rand(), true), 0);

    }

}
