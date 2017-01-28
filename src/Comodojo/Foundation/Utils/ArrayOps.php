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

class ArrayOps {

    public static function circularDiffKeys(array $left, array $right) {

        return [
            // only in left
            array_diff_key($left, $right),
            // common keys
            array_intersect_key($left, $right),
            // only in right
            array_diff_key($right, $left)
        ];

    }

    public static function filterByKeys(array $array_of_keys, array $array_to_filter) {

        return array_intersect_key($array_to_filter, array_flip($array_of_keys));

    }

    public static function replaceStrict(array $source, array ...$replace) {

        $replacements = [];

        foreach ($replace as $items) {
            $replacements[] = array_intersect_key($items, $source);
        }

        return array_merge($source, ...$replacements);

    }

}
