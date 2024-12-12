import { useParams } from "react-router-dom";
import { useState, useEffect } from "react";

const NewsDetail = () => {
  const { id } = useParams(); // Lấy id từ URL
  const [newsItem, setNewsItem] = useState(null);

  const news = [
    {
        id: 1,
        title: "Cập nhật xu hướng công nghệ 2024",
        summary: "Năm 2024 hứa hẹn sẽ có những thay đổi lớn trong ngành công nghệ với các xu hướng mới như AI, Blockchain và IoT.",
        image: "https://elcom.com.vn/storage/uploads/images/Fnju1yIhX4xswktmP8boatuF3SYRU1ElmPs1hMAF.jpg",
    },
    {
        id: 2,
        title: "Kinh tế toàn cầu năm 2024: Triển vọng và thách thức",
        summary: "Năm 2024, kinh tế toàn cầu đối mặt với nhiều thách thức, nhưng cũng mở ra cơ hội mới trong các lĩnh vực đầu tư và phát triển.",
        image: "https://static.tapchimattran.vn/Uploaded/htnhung/2024_02_05/116vtqf_OHOR.jpg",
    },
    {
        id: 3,
        title: "Đánh giá ASUS ExpertBook P5: Làm việc mượt hơn với trợ lý AI, pin 14 tiếng, business laptop nhưng hiệu năng gaming?",
        summary: "Không chỉ có ngoại hình nhỏ nhẹ, mềm mại và chuyên nghiệp, ASUS ExpertBook P5 sở hữu tất cả những tố chất, sức mạnh và tiềm năng cho tương lai để đảm đương mọi công việc một cách tròn vai, chu đáo miễn chê.",
        image: "https://cdn-media.sforum.vn/storage/app/media/nhatquang519/danh-gia-asus-expertbook-p5/danh-gia-asus-expertbook-p5-2024-cover.jpg",
    },
    {
        id: 4,
        title: "Những thay đổi trong luật Công nghiệp công nghệ số",
        summary: "Các quốc gia sẽ điều chỉnh và áp dụng các chính sách Công nghiệp công nghệ số để thích nghi với những thay đổi trong năm 2024.",
        image: "https://media.vneconomy.vn/640x360/images/upload/2021/08/26/luat-cong-nghe-so.jpg",
    },
    {
        id: 5,
        title: "Giới thiệu sản phẩm công nghệ mới của năm 2024",
        summary: "Năm 2024 sẽ là năm phát triển của các sản phẩm công nghệ, từ điện thoại thông minh đến các thiết bị thông minh khác.",
        image: "https://cdnphoto.dantri.com.vn/nDP3y18deL8bVOlQ50OgOYZSnZE=/2024/02/29/laptop-man-hinh-trong-suot-1-1709142433023.png",
    }
];


useEffect(() => {
    const currentNewsItem = news.find(item => item.id === parseInt(id));
    setNewsItem(currentNewsItem);
  }, [id]);

  if (!newsItem) return <div>Đang tải...</div>;

  return (
    <div className="p-8 bg-gray-100">
      <h1 className="text-4xl font-bold mb-4">{newsItem.title}</h1>
      <img src={newsItem.image} alt={newsItem.title} className="w-full h-64 object-cover rounded-md mb-4" />
      <p>{newsItem.content}</p>
    </div>
  );
};

export default NewsDetail;
