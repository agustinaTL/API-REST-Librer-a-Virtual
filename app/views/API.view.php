<?php
// Implementación API View

class APIView
{

<<<<<<< HEAD
  public function response($data, $status = 200)
  {
    header("Content-Type: application/json");
    header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
    echo json_encode($data);
  }

  private function _requestStatus($code)
  {
    $status = array(
      200 => "OK",
      201 => "Created",
      400 => "Bad Request",
      404 => "Not found",
      500 => "Internal Server Error"

    );
    return (isset($status[$code])) ? $status[$code] : $status[500];
  }
=======
    public function response($data, $status)
    {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        echo json_encode($data);
    }

    private function _requestStatus($code)
    {
        $status = array(
            200 => "OK",
            201 => "Created",
            400 => "Bad Request",
            404 => "Not found",
            500 => "Internal Server Error"

        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }
>>>>>>> 275abeea435bba936753d5999a90d2f2e8d9422f
}
