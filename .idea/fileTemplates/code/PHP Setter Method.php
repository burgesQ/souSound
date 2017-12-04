/**
 * Set ${NAME} 
 *
 * @param ${TYPE_HINT} $${PARAM_NAME}
 *
 * @return ${CLASS_NAME}
 */
public ${STATIC} function set${NAME}(#if (${SCALAR_TYPE_HINT})${SCALAR_TYPE_HINT} #else#end$${PARAM_NAME}) : ${CLASS_NAME}
{
#if (${STATIC} == "static")
    self::$${FIELD_NAME} = $${PARAM_NAME};
#else
    $this->${FIELD_NAME} = $${PARAM_NAME};
#end
    return $this;
}
