<?php

class CString
{
     public static function truncate($html, $max_length, $indicator = '&hellip;' )
    {
        $output_length = 0; // number of counted characters stored so far in $output
        $position = 0;      // character offset within input string after last tag/entity
        $tag_stack = array(); // stack of tags we've encountered but not closed
        $output = '';
        $truncated = false;

        /** these tags don't have matching closing elements, in HTML (in XHTML they
         * theoretically need a closing /> )
         * @see http://www.netstrider.com/tutorials/HTMLRef/a_d.html
         * @see http://www.w3schools.com/tags/default.asp
         * @see http://stackoverflow.com/questions/3741896/what-do-you-call-tags-that-need-no-ending-tag
         */
        $unpaired_tags = array( 'doctype', '!doctype',
            'area','base','basefont','bgsound','br','col',
            'embed','frame','hr','img','input','link','meta',
            'param','sound','spacer','wbr');

        // loop through, splitting at HTML entities or tags
        while ($output_length < $max_length
                && preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position))
        {
            list($tag, $tag_position) = $match[0];

            // get text leading up to the tag, and store it (up to max_length)
            $text = mb_strcut($html, $position, $tag_position - $position);
            if ($output_length + mb_strlen($text) > $max_length)
            {
                $output .= mb_strcut($text, 0, $max_length - $output_length);
                $truncated = true;
                $output_length = $max_length;
                break;
            }

            // store everything, it wasn't too long
            $output .= $text;
            $output_length += mb_strlen($text);

            if ($tag[0] == '&') // Handle HTML entity by copying straight through
            {
                $output .= $tag;
                $output_length++; // only counted as one character
            }
            else // Handle HTML tag
            {
                $tag_inner = $match[1][0];
                if ($tag[1] == '/') // This is a closing tag.
                {
                    $output .= $tag;
                    // If input tags aren't balanced, we leave the popped tag
                    // on the stack so hopefully we're not introducing more
                    // problems.
                    if ( end($tag_stack) == $tag_inner )
                    {
                        array_pop($tag_stack);
                    }
                }
                else if ($tag[mb_strlen($tag) - 2] == '/'
                        || in_array(strtolower($tag_inner),$unpaired_tags) )
                {
                    // Self-closing or unpaired tag
                    $output .= $tag;
                }
                else // Opening tag.
                {
                    $output .= $tag;
                    $tag_stack[] = $tag_inner; // push tag onto the stack
                }
            }

            // Continue after the tag we just found
            $position = $tag_position + mb_strlen($tag);
        }

        // Print any remaining text after the last tag, if there's room.
        if ($output_length < $max_length && $position < mb_strlen($html))
        {
            $output .= mb_strcut($html, $position, $max_length - $output_length);
        }
        
        $truncated = mb_strlen($html)-$position > $max_length - $output_length;

        // add terminator if it was truncated in loop or just above here
        if ( $truncated )
            $output .= $indicator;

        // Close any open tags
        while (!empty($tag_stack))
            $output .= '</'.array_pop($tag_stack).'>';

        return $output;
    }
    }
